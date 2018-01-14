<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Панель администратирования</title>
<link rel="stylesheet" href="tpl/css/style.css" type="text/css" />
<script type="text/javascript" src="tpl/js/jquery.js"></script>
<script type="text/javascript" src="tpl/js/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript" src="tpl/js/script.js"></script>
<script type="text/javascript" src="tpl/js/js.js"></script>
<link rel="icon" href="tpl/img/favicon.png" type="image/x-icon">
</head>
<body>
<div class="wrapper1">
<center>
<div id="mmm">
<div class="mmm">
<table cellpadding="0" class="col" width="100%" cellspacing="0">
<tr>
<td><a href="index.php"><img src="tpl/img/lamp.png" width="200px"/></a></td>
<td align="right">Добро пожаловать, <b><font color="#088bbc"><?=$_SESSION['admin_name']?></font></b>
&nbsp;&nbsp;
<img src="tpl/img/star.png"/>&nbsp;&nbsp;
<a href="index.php?a=exit" class="timezone">Выход</a>
</td>
</tr></table>
<table cellpadding="0" class="col2" cellspacing="0"><tr>
<td width="25px"><center><img src="tpl/img/star.png"/></center></td>
<td></td>
</tr></table>
</div>
</div>
<script>
var hours = <? echo date("H",time()); ?>;
var min = <? echo date("i",time()); ?>;
var sec = <? echo date("s",time()); ?>;
function display() {sec+=1;if (sec>=60){min+=1;sec=0;}if (min>=60){hours+=1;min=0;}if (hours>=24)hours=0;if (sec<10)sec2display = "0"+sec;else sec2display = sec;if (min<10)min2display = "0"+min;else min2display = min;if (hours<10)hour2display = "0"+hours;else hour2display = hours;document.getElementById("seconds").innerHTML = hour2display+":"+min2display+":"+sec2display;setTimeout("display();", 1000);}display();
</script>

<div id="menu">
<ul>

<a href="index.php?a=mag"><li><img src="tpl/img/shop1.png"/><div class="m">Каталог</div></li></a>
<a href="index.php?a=myinfo"><li><img src="tpl/img/conn.png"/><div class="m">Настройки</div></li></a>
<? if ($shopId==0) {?>
<a href="index.php?a=admins"><li><img src="tpl/img/employees1.png"/><div class="m">Админы</div></li></a>
<a href="index.php?a=shops"><li><img src="tpl/img/raz1.png"/><div class="m">Магазины</div></li></a>
<?} else { ?>


<a href="index.php?a=shop"><li><img src="tpl/img/raz1.png"/><div class="m">Магазин</div></li></a>
<? }; ?>



</ul>
</div>
<div style="clear:both;"></div>