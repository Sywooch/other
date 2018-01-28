<?php


if(isset($_GET["del"])){
$row_number = htmlspecialchars($_GET["del"]);    //номер строки которую удаляем
$file_out = file("otzivi.txt"); // Считываем весь файл в массив

 
$ts=explode("/#/", $file_out[$row_number]);
//удаляем записаную строчку
unset($file_out[$row_number]);
 
 
 
 ?>
 Отзыв 
 <span style="color: #ff0000;"> 
<?php echo $ts[0]; ?></span>  </h4> - <?php echo $ts[1]; ?> удален !
 <?php
//записали остачу в файл
file_put_contents("otzivi.txt", implode("", $file_out));
}


?>

<center><a href="http://prodlenka28.ru/admotz.php?4343">(Обновить)</a><h1> Отзывы: </h1>
<table width="70%">
<?php $i= -1;

	$f = fopen("otzivi.txt", "r");
	while(!feof($f)) { 
	    $tsitati[] = fgets($f);
	}
	fclose($f);
	$iii=0; foreach ($tsitati as $tsitata) :?>
	<?php $ts=explode("/#/", $tsitata); $i++;?>
<tr><td><h4 ><span style="color: #ff0000;">
<?php echo $ts[0]; ?></span>  </h4>	</td><td><?php echo $ts[1]; ?>
 </td><td><a href="admotz.php?del=<?php echo $i; ?>">Удалить</a></td></tr>
<?php endforeach; ?></table>


 
<h1> Добавить отзыв </h1>
<form id="feedback-form" action="add.php" method="POST">
<p>
 Ваше имя *:
 </p>
<p><input name="f1" required="" size="40" type="text" placeholder="Как Вас зовут" /></p>
<p>Ваш отзыв:</p>
<p> <textarea cols="40" name="f2" required="" rows="6" placeholder="Ваш отзыв"></textarea></p>
<p><input type="submit" value="Оставить отзыв" /></p>
</form></center>
