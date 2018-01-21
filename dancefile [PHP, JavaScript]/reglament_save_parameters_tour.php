<?php 

include('../db.php'); 


$id=$_POST['id'];//идентификатор тура
$vybr=$_POST['vybr'];//выбрать
$proshlo=$_POST['proshlo'];//прошло
$pr_ball=$_POST['pr_ball'];//проходной балл
$top_border=$_POST['top_border'];//верхняя граница
$bottom_border=$_POST['bottom_border'];//нижняя граница
$mode=$_POST['mode'];//режим
$plus=$_POST['plus'];//плюс





$rs=$mysqli->query("UPDATE active_reglament_tours SET vybr='".$vybr."',proshlo='".$proshlo."',pr_ball='".$pr_ball."',top_border='".$top_border."',bottom_border='".$bottom_border."',mode='".$mode."',plus='".$plus."' WHERE id='".$id."' "); 
		
if ($rs===false) {
	printf("Ошибка #1: %s\n", $mysqli->error);
}	




echo "Параметры тура успешно сохранены.";	


?>