<?php
session_start();
header('Content-type: text/html; charset=utf-8');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Компания предлагает полный цикл услуг в области строительства, реставрации, реконструкции, ремонта и отделочных работ, а также изготовление корпусной мебели по индивидуальным заказам физических и юридических лиц"/>
<meta name="keywords" content="компания спецстрой благовещенск" />
<meta name="robots" content="all"/>
<meta name="revisit-after" content="1 days"/>
<meta name="document-state" content="Dynamic"/>
<meta name="generator" content="notepad++ :)">
<meta name="author" content="retina-studio">
<meta http-equiv="X-UA-Compatible" content="IE=edge" ><!--всегда исползовать стандартный режим отображения-->
<link href="/favicon.png" rel="icon" type="image/png"/>

<title>Отзывы</title>

<link rel="stylesheet" href="css/global.css"/>
<link rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" href="css/style_header.css"/>
<link rel="stylesheet" href="css/style_content.css"/>
<link rel="stylesheet" href="css/style_footer.css"/>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/slides.min.jquery.js"></script>
<!--<script type="text/javascript" src="js/jquery-1.8.2.js"></script>-->
<script type="text/javascript" src="js/jquery.highlight.js"></script>
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
			//		window.location.hash = '#' + current;
				}
			});
		});
	</script>
<script type="text/javascript">

function tmp(form){
if(form.vote_check[0].checked){ 
 search_submit(form);
 }
if(form.vote_check[1].checked){

  var searchTerm=$('#inputtext_id').val();
  $('table').removeHighlight();
  if(searchTerm){
  $('table').highlight(searchTerm);
  }
         
	
  
  
}//form.vote_check[1].checked



}



function click_radio(){
//document.getElementById('search_method').style.display='none';
$('select#search_method').fadeOut(1500);
}

function click_radio2(){
//document.getElementById('search_method').style.display='inline';
$('select#search_method').fadeIn(1500);
}

function f_show(){
$("#f").show(2000);
}


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
						<img src="img/slides/index/1.jpg" alt="компания спецстрой благовещенск"/>
					</div>
					<div class="slide">
						<img src="img/slides/index/2.jpg" alt="работы по реставрации"/>
					</div>
					<div class="slide">
						<img src="img/slides/index/3.jpg" alt="реставрационные работы"/>						
					</div>
					<div class="slide">
						<img src="img/slides/index/4.jpg" alt="классические принципы реставрации"/>					
					</div>
					<div class="slide">
						<img src="img/slides/index/5.jpg" alt="компания спецстрой благовещенск"/>						
					</div>
					
				</div>
				</div>
			</div>
			</div>
</div><!--слайдер-->
<div align="right" style="height:87px; width:100px; margin-top:-127px; margin-left:650px; position:relative; z-index:999999">
<img src="images/man.png" alt="ремонтно-строительная компания" style="float:right"/>
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
<div class="new_left_menu" ><!--левое меню-->
<?php
include("templates/left_menu.php");
?>

<?php
include("content/responses_content_left.php");
?>

</div><!--левое меню-->
<div class="new_center_block" ><!--центральный блок с контентом-->
<div class="myriad_pro12 content">

<table  width="602px" align="center" border="0" cellpadding="0" cellspacing="0"  style="position:relative;z-index:9999999; color:#735f50">
		<tbody>
		<tr>
						<td class="style19 content_table_td">
			<p class="style75" align="justify">
			
			<h1 class="myriad_pro14">Отзывы</h1>
			
			<div style="width:520px; height:650px; border-style:solid; border-width:1px; border-color:white;padding:10px; overflow:auto">
		
		<?php
		$dbh=mysql_connect('localhost','root','fiexitheitheivae')or die("".mysql_errno() . ": " . mysql_error()." Невозможно соединиться с MySQL сервером!");
		mysql_select_db('db_specstroy')or die("Невозможно подключиться к базе!");
		$query="SELECT * FROM response_table ORDER BY date_time DESC";
		$res = mysql_query($query);
		if($res==false){
					echo"Ошибка выполнения запроса.";
					echo mysql_error();
					exit; }
		
		
		
		 while($row=mysql_fetch_array($res)){
		echo' <p class="myriad_pro12">';
		echo' <span class="myriad_pro12_strong"><strong>';
		$f2=$row['name'];
		//перевод на русский язык названий дней недели.
		$week_rus=array("Понедельник","Вторник","Среда","Четверг","Пятница","Суббота","Воскресенье");		
		$week_eng=array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
		$row['date_time'] = str_replace( $week_eng, $week_rus, $row['date_time'] );
		
		echo"".$f2." / ".$row['date_time']."";
		echo'</strong></span></br>';
		$f2=$row['text'];
		echo"".$f2."";			
		echo'</p>';
		echo'<hr size="1">';
			
		 
		 
		 }
		
				
			
		?>	
			
		
			</div>
			
			<div id="f2" name="f2" style="width:520px; height:30px; margin-top:10px">
			<input name="Button1" type="button" value="Оставить отзыв" onclick="f_show()" />
			</div>
			<div id="f" name="f" style="width:520px; height:250px; border-style:solid; border-width:1px; 
			border-color:white;padding:10px; margin-top:10px; display:none">
			 <form id="responsesForm" action="action/action_responses.php" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					
                        <table border="0">
                            <tr><!--имя-->
                                <td style="height: 35px; width: 130px;border-style:solid; border-width:1px; border-color:white">
								<span style="margin-left:20px">Ваше имя</span>
								</td> 
								
                                <td style="height: 35px; width:360px;border-style:solid; border-width:1px; border-color:white">
								 <input type="text" name="title" maxlength="30" style="width: 200px;background-color:#FFFF99;margin-left:3px"/>
								</td>
                            </tr><!--имя-->
							
                            <tr><!--текст-->
                                <td style="height: 85px; width:130px; border-style:solid; border-width:1px; border-color:white">
								<span style="margin-left:20px">Текст</span>
								</td> 
								
                                <td style="height:85px; width:360px; border-style:solid; border-width:1px; border-color:white">
								<textarea name="comment" maxlength="500" style="margin-left:3px; height:70px; width:330px;background-color:#FFFF99;
								max-height:80px; max-width:330px"></textarea>
								</td>
                            </tr><!--текст-->
		                     <tr><!--текст-->
   
   <?php
   //генерация случайных чисел для антибот системы
   $x1=rand(0,9);
   $x2=rand(0,9);
   $x3=rand(0,9);
   $x4=rand(0,9);
$_SESSION['sum']=$x1."".$x2."".$x3."".$x4;
   
 
   
      

				echo'				<td style="height: 40px; width:90px; border-style:solid; border-width:1px; border-color:white; padding-top:8px;
								padding-bottom:8px; padding-left:20px; padding-right:20px; text-align:left">
								<span >Введите число с картинки:</span>
								</td> 
								<td style="height:40px; width:360px; border-style:solid; border-width:1px; border-color:white; padding-top:13px;
								padding-bottom:13px">
								<div style="height:20px; width:360px">
								 <input type="text" name="bot" id="bot" maxlength="30" style="width: 150px;background-color:#FFFF99;margin-left:3px; float:left"/>
								
								
								<div style="height:18px; width:130px; margin-left:10px; margin-top:3px; float:left">';
			
                          echo"
								<div style=\"float:left; height:18px; width:13px;background-image:url('/images/antibot/".$x1.".jpg'); \"></div>
								<div style=\"float:left; height:18px; width:13px;background-image:url('/images/antibot/".$x2.".jpg'); \"></div>
								<div style=\"float:left; height:18px; width:13px;background-image:url('/images/antibot/".$x3.".jpg'); \"></div>
								<div style=\"float:left; height:18px; width:13px;background-image:url('/images/antibot/".$x4.".jpg'); \"></div>
								</div>";
								
								
						echo'		</div>
								
								</td>';
           ?>                    
                            </tr><!--текст-->
                        </table>
                        <input type="submit" name="submit" value="Готово" 
						style="width: 119px; height: 38px; margin-top:10px; 
						-moz-border-radius: 5px;
						-webkit-border-radius: 5px;
						border-radius: 5px;
						background-image:url('images/button.png');"/>
						
                        <input type="reset" value="Сброс" 
						style="width: 119px; height: 38px; margin-top:10px " />
						
  
                        
						

                    </form>
			
			</div>

			<?php
			include("content/responses_content.php");
			?>
		
			
			</p></td>
		</tr>
	</tbody></table>


</div>
</div><!--центральный блок с контентом-->

<?php
include("templates/news2.php");
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
