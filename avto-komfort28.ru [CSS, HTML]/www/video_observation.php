<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>���������������</title>

<link rel="stylesheet" href="css/style.css"/>
<map name="ImageMap">
<area href="index.php" shape="rect" alt="not image" coords="99, 0, 203, 106"/>
<area href="index.php" shape="rect" alt="not image" coords="221, 17, 697, 63"/>
</map>
<script type="text/javascript" src="js/jquery-1.8.2.js"></script>
<script type="text/javascript" src="js/jquery.highlight.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

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
<div class="div1_style"><!--����� ����-->
<div class="header_style"><!--�����-->
<div align="left" class="header_up_style"><!--������� �������� �����-->
<div class="div2_style">
<img style="margin-left:60px" src="images/logo.png" alt="" usemap="#ImageMap"  border="0"/>
</div>
</div><!--������� �������� �����-->
<div align="left" class="header_center_style"><!--����������� �������� �����-->
<div align="center" class="div3_style">

</div>





</div><!--����������� �������� �����-->

<div align="center" class="header_down_style"><!--������ �������� �����-->
<div class="menu_style"><!--����-->
<?php
include("templates/menu_video_observation.php");
?>

</div><!--����-->

</div><!--������ �������� �����-->

</div><!--�����-->
<!--===============================================================================================================-->
<div align="center" class="content_style"><!--�������-->
<table style="margin-top:20px" width="910px" align="center" border="0" cellpadding="0" cellspacing="0">
<tr>
<td align="justify" class="td_style">
<?php
include("content/content_video_observation.php");
?>
</td>
</tr>

</table>

</div><!--�������-->
<!--=======================================================-->
<div align="center" class="footer_style"><!--������-->


</div><!--������-->





</div><!--����� ����-->




</div>


</body>

</html>
