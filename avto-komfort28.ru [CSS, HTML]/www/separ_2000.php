<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>—епар-2000</title>

<link rel="stylesheet" href="css/style.css"/>
<map name="ImageMap">
<area href="index.php" shape="rect" alt="not image" coords="99, 0, 203, 106"/>
<area href="index.php" shape="rect" alt="not image" coords="221, 17, 697, 63"/>
</map> 
<script type="text/javascript" src="js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="js/jquery.highlight.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script type="text/javascript">

  function DisBlock2(){
   $('div#rightcol').fadeIn(1500);
   					}
  function close_block(){
   $('div#rightcol').fadeOut(1500);
  	}

  function DisBlock2_2(){
   $('div#rightcol2').fadeIn(1500);
   					}
  function close_block_2(){
   $('div#rightcol2').fadeOut(1500);
  	}
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>

<script language="javascript" type="text/javascript">
function doMenu(){

if(chapter.style.display=='none'){
chapter.style.display='block';}

}

function doMenu2(){
if(chapter.style.display=='block'){
chapter.style.display='none';}

}

function doMenu3(){
if(chapter.style.display=='block'){
setTimeout(func, 3000);
}
function func() {
  chapter.style.display='none';
}


}
</script>
</head>

<body class="body_style">
<div align="center" style="width:100%">
<div class="div1_style"><!--общий блок-->
<div class="header_style"><!--шапка-->
<div align="left" class="header_up_style"><!--верхн€€ половина шапки-->
<div class="div2_style">
<img style="margin-left:60px" src="images/logo.png" alt="" usemap="#ImageMap"  border="0"/>
</div>
</div><!--верхн€€ половина шапки-->
<div align="left" class="header_center_style"><!--центральна€ половина шапки-->
<div align="center" class="div3_style">

</div>





</div><!--центральна€ половина шапки-->

<div align="center" class="header_down_style"><!--нижн€€ половина шапки-->
<div class="menu_style"><!--меню-->
<?php
include("templates/menu_separ_2000.php");
?>

</div><!--меню-->

</div><!--нижн€€ половина шапки-->

</div><!--шапка-->
<!--===============================================================================================================-->
<div align="center" class="content_style"><!--контент-->
<table style="margin-top:20px" width="910px" align="center" border="0" cellpadding="0" cellspacing="0">
<tr>
<td  align="justify" class="td_style">
<?php
include("content/content_separ_2000.php");
?>
</td>
</tr>

</table>

</div><!--контент-->
<!--=======================================================-->
<div align="center" class="footer_style"><!--подвал-->


</div><!--подвал-->





</div><!--общий блок-->




</div>


<div class="rightcol_style" id="rightcol" name="rightcol" onclick="close_block()" style="width:100%;height:100%">
<div style="top:50%;left:50%; position:absolute;margin:-280px 0 0 -250px;"><img src="images/separ-2000_big.jpg"/></div>
</div>

<div class="rightcol_style" id="rightcol2" name="rightcol2" onclick="close_block_2()" style="width:100%;height:100%">
<div style="top:50%;left:50%; position:absolute;margin:-252px 0 0 -180px;"><img src="images/separ_big.jpg"/></div>
</div>

</body>

</html>
