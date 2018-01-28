<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>





			</div>
		</div>

		<div id="space-for-footer"></div>
	</div>








<!----=========================================-->
</div>
<!--center div -->

<!--right div-->
<div align="center" style="width:327px; height:1000px; background-color:transparent; float:left;">

<div align="center" style="width:327px; height:600px;"></div>

<div align="center" style="width:327px; height:286px; background-color:transparent;">
<div align="center" style="width:40px; height:286px; float:left;"></div>

<!--book-->
<a href=" /kniga_20_let.php ">
<div align="center" onclick="button_book();" onmousedown="button_book();" id="button_book" style="width:238px; height:286px; float:left; background-color:transparent;" class="div_book"></div>
</a>

<script type="text/javascript">
function button_book(){


$("#button_book").css("background-image", "url(/press_button_images/press_kniga.png)");

}
</script>
<!--book-->
</div>


</div>
<!--right div-->



</div>
</div>
</div>
</div>


<?

$CurrPage = $APPLICATION->GetCurPage(true);


     $HomePage1 = "1_soziv";
     $HomePage2 = "2_soziv";
     $HomePage3 = "3_soziv";
     $HomePage4 = "4_soziv";
     $HomePage5 = "5_soziv";

$pi = explode("/", $CurrPage);

if (($pi[1]==$HomePage1)||($pi[1]==$HomePage2)||($pi[1]==$HomePage3)||($pi[1]==$HomePage4)||($pi[1]==$HomePage5))  {

echo'
<!--fixed panel-->
<div align="center" style="width:100%; height:60px; position:fixed; background-color:transparent; top:100%; margin-top:-60px; z-index:99999999;">
 
<div align="center" style="width: 100%; height: 60px;"> 

<div align="center" style="width:1000px; height:60px; background-color:#f0f0f0;">
<div align="center" style="width:1000px; height:4px; "></div>

<a href="  ';

     echo"informacija_o_sozive.php"; 

echo '  " style="color:black; text-decoration:none;">
  <div id="div_160_1" align="center" style=" height: 46px; width:200px; background-color: transparent; float: left; cursor:pointer;  " class=" fon_200" onclick="div_160_1();" onmousedown="div_160_1();">
<span style="font-size: 13pt; font-family: Tahoma; color: rgb(67, 94, 130);"><strong>Информация о</br> созыве</strong></span> 
</div>
</a>

 
<a href="struktura.php" style="color:black; text-decoration:none;">
  <div id="div_160_2" align="center" style="width: 160px; height: 46px; background-color: transparent; float: left;  cursor:pointer; margin-left: 10px;" class=" fon_160" onclick="div_160_2();" onmousedown="div_160_2();">
<span style="font-size: 13pt; font-family: Tahoma; color: rgb(67, 94, 130);"><strong>Структура</br> собрания</strong></span> 
</div>
</a>

<a href=" ';

echo"deputati.php";  

echo' " style="color:black; text-decoration:none;"> 
  <div id="div_160_3" align="center" style="width: 220px; height: 46px; background-color: transparent; float: left; cursor:pointer; margin-left: 10px;" class=" fon_220" onclick="div_160_3();" onmousedown="div_160_3();">
<div style="width:220px; height:10px;"></div>
<span style="font-size: 13pt; font-family: Tahoma; color: rgb(67, 94, 130); "><strong>Список депутатов</strong></span> 
</div>
 </a>

<a href=" ';

 echo"fotocatalog.php";  

echo' " style="color:black; text-decoration:none;">
  <div id="div_160_4" align="center" style="width: 180px; height: 46px; background-color: transparent; float: left; cursor:pointer; margin-left: 10px;" class=" fon_180" onclick="div_160_4();" onmousedown="div_160_4();">
<div style="width:180px; height:10px;"></div>
<span style="font-size: 13pt; font-family: Tahoma; color: rgb(67, 94, 130);"><strong>Фотокаталог</strong></span> 
</div>
 </a>

<a href="video.php" style="color:black; text-decoration:none;"><span style="font-size: 13pt; font-family: Tahoma; color: rgb(67, 94, 130); ">
<div id="div_160_5" align="center" style="width: 150px; height: 46px; background-color: transparent; float: left; cursor:pointer; margin-left: 10px;  font-size: 13pt; font-family: Tahoma; color: rgb(67, 94, 130);
" 
class=" fon_150" onclick="div_160_5();" onmousedown="div_160_5();">
<div style="width:150px; height:10px;"></div>
<strong>Видео</strong></span>
</div>
</a> 

 </div>
</div>
</div>
<!--fixed panel-->

<script type="text/javascript">
function div_160_1(){

$("#div_160_1").css("background-image", "url(/press_button_images/press_7_200.png)");

}
function div_160_2(){

$("#div_160_2").css("background-image", "url(/press_button_images/press_7_160.png)");

}
function div_160_3(){

$("#div_160_3").css("background-image", "url(/press_button_images/press_7_220.png)");

}
function div_160_4(){

$("#div_160_4").css("background-image", "url(/press_button_images/press_7_180.png)");

}
function div_160_5(){

$("#div_160_5").css("background-image", "url(/press_button_images/press_7_150.png)");

}
</script>

 ';

 }
     else {
};

?>




</body>
</html>